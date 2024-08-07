<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalComment extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $title;
    public $scrollable;
    public $body;
    public $footer;
    public function __construct($id, $title, $scrollable = false, $body = null, $fter = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->scrollable = $scrollable;
        $this->body = $body;
        $this->footer = $fter;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-comment');
    }
}
