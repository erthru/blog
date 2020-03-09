<html>
    <head>
        @include("head")
        <title>Dashboard @yield("title") | {{ env("APP_NAME") }}</title>
    </head>

    <body>
        <header>
            <div class="dashboard-header-section">
                <a href="#collapseSidebar" class="pr-3 dashboard-header-toggler" data-toggle="collapse"><i class="fas fa-bars fa-1x text-white"></i></a>
                <span><strong>Dashboard</strong></span>
                <a href="/dashboard/logout"><i class="fas fa-sign-out-alt fa-1x text-white" style="position: absolute; right: 16px"></i></a>
            </div>
        </header>

        <main>
           <div class="row">
               <div class="col-12 col-md-2 collapse dont-collapse-xs dahboard-sidebar" id="collapseSidebar">
                    <div class="container mt-3">
                        <a href="/dashboard/content">
                            <div class="row">
                                <div class="col-2 align-self-right">
                                    <i class="fas fa-book" style="font-size: 24px"></i>
                                </div>

                                <div class="col-10">
                                    <strong>Konten</strong>
                                </div>
                            </div>
                        </a>

                        <hr />

                        <a href="#">
                            <div class="row">
                                <div class="col-2 align-self-right">
                                    <i class="fas fa-quote-left" style="font-size: 24px"></i>
                                </div>

                                <div class="col-10">
                                    <strong>Quote</strong>
                                </div>
                            </div>
                        </a>

                        <hr />

                        <a href="#">
                            <div class="row">
                                <div class="col-2 align-self-right">
                                    <i class="fas fa-hashtag" style="font-size: 24px"></i>
                                </div>

                                <div class="col-10">
                                    <strong>Tags</strong>
                                </div>
                            </div>
                        </a>

                        <hr />

                        <a href="#">
                            <div class="row">
                                <div class="col-2 align-self-right">
                                    <i class="fas fa-user" style="font-size: 24px"></i>
                                </div>

                                <div class="col-10">
                                    <strong>Penulis</strong>
                                </div>
                            </div>
                        </a>
                    </div>
               </div>

               <div class="col-12 col-md-10">
                    @yield("main")
               </div>
           </div>   
        </main>

        <footer>
            <div class="dashboard-footer-section">
                <div style="position:absolute; right: 16px;">
                    &copy; {{ now()->year }} - erthru.id
                </div>
            </div>
        </footer>
    </body>
</html>