@extends('app.layout')

@section('content')
<!-- Header Section -->
<header>
    <div class="overlay"></div>
    <div class="header-container">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="217.407" height="225.366">
                <g data-name="Group 21" fill="#fff" stroke="#0c193f" stroke-linejoin="round" stroke-miterlimit="10"
                    stroke-width="9">
                    <path data-name="Path 2"
                        d="M129.451 76.622h-41.64l-20.82 36.061 20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 3"
                        d="M192.088 40.561h-41.64l-20.82 36.061 20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 4"
                        d="M192.088 112.683h-41.64l-20.82 36.061 20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 5"
                        d="M129.451 148.744h-41.64l-20.819 36.065 20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 6" d="M66.96 112.683H25.32L4.5 148.744l20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 7" d="M66.96 40.561H25.32L4.5 76.622l20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 8" d="M129.451 4.5h-41.64l-20.82 36.061 20.82 36.061h41.64l20.82-36.061z" />
                    <path data-name="Path 9" d="M129.451 4.5h-41.64l-20.82 36.061 20.82 36.061h41.64l20.82-36.061z" />
                </g>
            </svg>
        </div>
        <div class="title">
            <h1>Darkchan</h1>
        </div>
        <div class="paragraph col-8 text-center">
            Darkchan is a simple image-based bulletin board where anyone can post
            comments and share images. There are boards dedicated to a variety of
            topics, from Japanese animation and culture to videogames, music, and
            photography. Users do not need to register an account before
            participating in the community. Feel free to click on a board below
            that interests you and jump right in!
        </div>
    </div>
    <div class="arrow" id="arrow">
        <i class="fas fa-chevron-down"></i>
    </div>
</header>

{{-- Boards --}}
@component('components.boards', compact('boards'))
Boards
@endcomponent
{{-- Boards --}}

@endsection