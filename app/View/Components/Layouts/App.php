<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * title page
     *
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.app');
    }
}
