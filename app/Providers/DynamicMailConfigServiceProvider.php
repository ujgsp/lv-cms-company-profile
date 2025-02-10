<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DynamicMailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureMailSettings();
    }

    protected function configureMailSettings()
    {
        try {
            // Pastikan tabel 'options' sudah ada sebelum melakukan query
            if (!Schema::hasTable('options')) {
                Log::warning("Tabel 'options' belum tersedia, melewati konfigurasi email.");
                return;
            }

            $opt_email = Option::where('option_name', 'setting_contact_info')->first();

            if ($opt_email) {
                $setting_email = json_decode($opt_email->option_value, true);

                // Cek apakah SMTP diaktifkan
                if (isset($setting_email['smtp_status']) && $setting_email['smtp_status'] === 'enable') {
                    Config::set('mail.mailers.smtp.host', $setting_email['smtp_host'] ?? '');
                    Config::set('mail.mailers.smtp.port', $setting_email['smtp_port'] ?? '');
                    Config::set('mail.mailers.smtp.username', $setting_email['smtp_user'] ?? '');
                    Config::set('mail.mailers.smtp.password', $setting_email['smtp_pass'] ?? '');
                    Config::set('mail.mailers.smtp.encryption', $setting_email['smtp_encryption'] ?? '');
                    Config::set('mail.from.address', $setting_email['email'] ?? '');
                    Config::set('mail.from.name', $setting_email['email_from_name'] ?? '');

                    Log::info('Konfigurasi SMTP berhasil diterapkan.');
                } else {
                    Log::warning('SMTP dinonaktifkan dalam pengaturan.');
                }
            } else {
                Log::warning("Pengaturan email tidak ditemukan dalam tabel 'options'.");
            }
        } catch (\Exception $e) {
            Log::error("Terjadi kesalahan saat mengatur konfigurasi email: " . $e->getMessage());
        }
    }
}
