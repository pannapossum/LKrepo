<nav class="navbar navbar-expand-md navbar-dark" id="headerNav">

    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('lorekeeper.settings.site_name', 'Lorekeeper') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a class="nav-link d-flex text-warning" href="{{ url('news') }}"><strong>News</strong><i class="fas fa-bell"></i></a>
                    @else
                        <a class="nav-link" href="{{ url('news') }}">News</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a class="nav-link d-flex text-warning" href="{{ url('sales') }}"><strong>Sales</strong><i class="fas fa-bell"></i></a>
                    @else
                        <a class="nav-link" href="{{ url('sales') }}">Sales</a>
                    @endif
                </li>
                @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('info/about') }}">Home</a>
                    @endif
                    
                    <li class="nav-item dropdown">
                        <a id="queueDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Info
                        </a>
                        <div class="dropdown-menu" aria-labelledby="queueDropdown">
                            <a class="dropdown-item" href="{{ url('info/sigillants') }}">
                                Sigillants
                            </a>
                            <a class="dropdown-item" href="{{ url('world/traits') }}">
                                Traits
                            </a>
                            <a class="dropdown-item" href="{{ url('world') }}">
                                Encyclopedia
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('info/starterguide') }}">
                                Starter Guide
                            </a>
                            <a class="dropdown-item" href="{{ url('info/uploadguide') }}">
                                Upload Guides
                            </a>
                            <a class="dropdown-item" href="{{ url('info/designguide') }}">
                                Design Guide
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('faq') }}">
                                FAQ
                            </a>
                        </div>
                    </li>

                    @if (Auth::check())
            <li class="nav-item dropdown">
                <a id="queueDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Play
                        </a>
                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('info/casino') }}">
                                Casino
                            </a>
                            <a class="dropdown-item" href="{{ url(__('cultivation.cultivation')) }}">
                                {{__('cultivation.cultivation')}}
                            </a>
                            <a class="dropdown-item" href="{{ url('foraging') }}">
                                Foraging
                            </a>
                            <a class="dropdown-item" href="{{ url('encounter-areas') }}">
                                Encounters
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('prompts/prompts') }}">
                                Prompts
                            </a>
                            <a class="dropdown-item" href="{{ url('collection') }}">
                                Collections
                            </a>
                            <a class="dropdown-item" href="{{ url('crafting') }}">
                                Crafting
                            </a>
                            <a class="dropdown-item" href="{{ url('raffles') }}">
                                Raffles
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('shops') }}">
                                Shops
                            </a>
                        </div>
                @endif


                <li class="nav-item dropdown">
                    <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Browse
                    </a>

                    <div class="dropdown-menu" aria-labelledby="browseDropdown">

                         <a class="dropdown-item" href="{{ url('masterlist') }}">
                            Character Masterlist
                        </a>
                        <a class="dropdown-item" href="{{ url('sublist/NPC') }}">
                            NPC Masterlist
                        </a>
                        <a class="dropdown-item" href="{{ url('users') }}">
                            User Masterlist
                        </a>
                    </div>
                
                    <li class="nav-item dropdown">
                    <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Community
                    </a>

                    <div class="dropdown-menu" aria-labelledby="browseDropdown">

                         <a class="dropdown-item" href="{{ url('info/rules') }}">
                           Rules
                        </a>
                        <a class="dropdown-item" href="{{ url('info/discord') }}">
                            Discord
                        </a>
                    </div>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('gallery') }}">Gallery</a>
                </li>
            </ul>
            

            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->isStaff)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-crown"></i></a>
                        </li>
                    @endif
                    @if (Auth::user()->notifications_unread)
                        <li class="nav-item">
                            <a class="nav-link btn btn-secondary btn-sm" href="{{ url('notifications') }}"><span class="fas fa-envelope"></span> {{ Auth::user()->notifications_unread }}</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Account
                        </a>
                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('characters') }}">
                                My Characters
                            </a>
                            <a class="dropdown-item" href="{{ url('characters/myos') }}">
                                My MYO Slots
                            </a>
                            <a class="dropdown-item" href="{{ url('pets') }}">
                                My Pets
                            </a>
                            <a class="dropdown-item" href="{{ url('inventory') }}">
                                Inventory
                            </a>
                            <a class="dropdown-item" href="{{ url('bank') }}">
                                Bank
                            </a>
                            <a class="dropdown-item" href="{{ url('awardcase') }}">
                                {{ ucfirst(__('awards.awards')) }}
                            </a>                            
                            <a class="dropdown-item" href="{{ url('comments/liked') }}">
                                Liked Comments
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('trades/open') }}">
                                Trades
                            </a>
                            <a class="dropdown-item" href="{{ url('characters/transfers/incoming') }}">
                                Character Transfers
                            </a>
                            <a class="dropdown-item" href="{{ url('characters/pairings') }}">
                                Character Pairings
                            </a>
                            <a class="dropdown-item" href="{{ url('designs') }}">
                                Design Approvals
                            </a>



                    <li class="nav-item dropdown">
                        <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Submit
                        </a>

                        <div class="dropdown-menu" aria-labelledby="browseDropdown">
                            <a class="dropdown-item" href="{{ url('submissions/new') }}">
                                Submit Prompt
                            </a>
                            <a class="dropdown-item" href="{{ url('claims/new') }}">
                                Submit Claim
                            </a>
                            <a class="dropdown-item" href="{{ url('reports/new') }}">
                                Submit Report
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('submissions') }}">
                                Submissions
                            </a>
                            <a class="dropdown-item" href="{{ url('claims') }}">
                                Claims
                            </a>
                            <a class="dropdown-item" href="{{ url('reports/bug-reports') }}">
                                Bug Reports
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('redeem-code') }}">
                                Redeem Code
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->url }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ url('notifications') }}">
                                Notifications
                            </a>
                            <a class="dropdown-item" href="{{ url('account/bookmarks') }}">
                                Bookmarks
                            </a>
                            <a class="dropdown-item" href="{{ url('account/settings') }}">
                                Settings
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>