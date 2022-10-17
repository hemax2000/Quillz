<nav class="navbar navbar-expand-md navbar-dark bg-black shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Quillz') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li><a href="/" class="nav-link px-2 text-white">Home</a></li>
                <li><a href="/features" class="nav-link px-2 text-white">Features</a></li>
                <li><a href="/faqs" class="nav-link px-2 text-white">FAQs</a></li>
                <li><a href="/about" class="nav-link px-2 text-white">About</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Search box
                ========================================== -->

                {!! Form::open(['action' => ['App\Http\Controllers\ActiveQuizController@checkCode'], 'method' => 'POST', 'class' => 'col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3']) !!}
                <div class="form-group">
                    {{ Form::search('code', '', ['class' => 'form-control form-control-dark', 'placeholder' => ' Enter Room Code']) }}
                </div>
                {!! Form::close() !!}
                <!-- Language
                ========================================== -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle me-2" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (LaravelLocalization::setLocale() == "ar")
                            Eng
                        @else
                            ع
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-light">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li id="{{ $localeCode }}">
                                <a class="dropdown-item" rel="alternate" onclick="changeSides()"
                                    hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>



                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="/home">Dashboard</a>
                            <a class="dropdown-item" href="/questionBank">Question Bank</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
