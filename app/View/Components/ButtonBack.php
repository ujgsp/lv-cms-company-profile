<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonBack extends Component
{
    public $url;
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $label = 'Back')
    {
        $this->url = $url;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button-back');
    }
}
