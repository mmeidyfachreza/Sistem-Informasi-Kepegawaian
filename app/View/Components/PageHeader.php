<?php

namespace App\View\Components;

use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Null_;

class PageHeader extends Component
{

    /**
     * The page name.
     *
     * @var string
     */
    public $name;

    /**
     * The page section name.
     *
     * @var string
     */
    public $section;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$section = Null)
    {
        $this->name = $name;
        $this->section = $section;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-header');
    }
}
