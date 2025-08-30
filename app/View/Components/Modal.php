<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $name;
    public $show;
    public $maxWidth;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $show = false, $maxWidth = '2xl')
    {
        $this->name = $name;
        $this->show = $show;
        $this->maxWidth = $maxWidth;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
