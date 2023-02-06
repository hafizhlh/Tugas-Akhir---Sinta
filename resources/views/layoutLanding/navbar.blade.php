<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex align-items-center">
        <h2 class="m-0 text-primary"><img class="img-fluid me-2" src="{{ asset('landingPage/img/logopetroport.png') }}" alt=""
            style="width: 250px;"></h2>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
   <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-4 py-lg-0">
            <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="home"> Home</a>
                    <div class="dropdown-menu dropdown-large p-4 shadow-sm m-0">
                        <div class="row gx-5 p-4">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="/" class="nav-item">Tentang TI</a></li><hr>
                                    <li><a href="#" class="nav-item">Awarding</a></li><hr>
                                    <li><a href="#" class="nav-item">ITSC & IT Agent PKG</a></li><hr>
                                    <li><a href="#" class="nav-item">Annual Report</a></li>
                                </ul>
                            </div><!-- end col-3 -->
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="nav-item">Telp ext</a></li><hr>
                                    <li><a href="#" class="nav-item">Daftar aplikasi TI (internal)</a></li><hr>
                                    <li><a href="#" class="nav-item">Template Dokumen TI</a></li>
                                </ul>
                            </div><!-- end col-3 -->
                        </div><!-- end row -->
                    </div> <!-- dropdown-large.// -->
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-parent" href="#" data-bs-toggle="dropdown" id="tentangTI">Tentang TI</a>
                <div class="dropdown-menu dropdown-xlarge p-4 shadow-sm">
                    <ul class="list-unstyled">
                        <li><a href="/tentang-TI" class="nav-item">Sejarah TI</a></li><hr>
                        <li><a href="/tentang-TI#tugas-dan-tanggung-jawab-TI" class="nav-item">Tugas dan Tanggung Jawab Bagian</a></li><hr>
                        <li><a href="/tentang-TI#struktur-organisasi-ti" class="nav-item">Struktur Organisasi TI</a></li>
                    </ul>
                </div> <!-- dropdown-large.// -->
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-parent" href="#" data-bs-toggle="dropdown" id="ITSC">ITSC</a>
                <div class="dropdown-menu dropdown-xlarge p-4 shadow-sm">
                    <ul class="list-unstyled">
                        <li><a href="#" class="nav-item">Tugas dan Tanggung Jawab ITSC</a></li><hr>
                        <li><a href="#" class="nav-item">Anggota ITSC</a></li>
                    </ul>
                </div> <!-- dropdown-large.// -->
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-parent" href="#" data-bs-toggle="dropdown" id="ITAgent">IT Agent</a>
                <div class="dropdown-menu dropdown-xlarge p-4 shadow-sm">
                    <ul class="list-unstyled">
                        <li><a href="/it-agent" class="nav-item">Tugas dan Tanggung Jawab IT Agent</a></li><hr>
                        <li><a href="#" class="nav-item">Anggota IT Agent</a></li>
                    </ul>
                </div> <!-- dropdown-large.// -->
            </div>

            <a href="#" class="nav-item nav-link nav-parent" id="BeritaTI">Berita TI</a>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-parent" href="#" data-bs-toggle="dropdown" id="SecurityAwareness">Security Awareness</a>
                <div class="dropdown-menu dropdown-xlarge p-4 shadow-sm">
                    <ul class="list-unstyled">
                        <li><a href="/security-awareness" class="nav-item">Poster</a></li><hr>
                        <li><a href="#" class="nav-item">Download Materi</a></li>
                    </ul>
                </div> <!-- dropdown-large.// -->
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-parent" href="#" data-bs-toggle="dropdown" id="FAQ">FAQ</a>
                <div class="dropdown-menu dropdown-xlarge p-4 shadow-sm">
                    <ul class="list-unstyled">
                        <li><a href="#" class="nav-item">Self Diagnoses</a></li><hr>
                        <li><a href="#" class="nav-item">Tutorial</a></li>
                    </ul>
                </div> <!-- dropdown-large.// -->
            </div>

            <a href="/tautan" class="nav-item nav-link nav-parent" id="Tautan">Tautan</a>

            <a href="/login" class="nav-item nav-link"><img class="img-fluid me-2" src="{{ asset('landingPage/img/download.png') }}" alt="" 
                style="width: 20px;">Petroport</a>
    </div>
</nav>