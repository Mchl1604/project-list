<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">
</head>

<body>
    @php
        $user = auth()->user();
        $userName = $user?->name ?? 'Guest';
        $avatarUrl =
            'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0B0F0C&color=FFFFFF&size=80';
    @endphp

    <nav class="navbar navbar-expand-lg navbar-projecthub sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand projecthub-brand" href="{{ url('/dashboard') }}">ProjectHub</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#projecthubNavbar"
                aria-controls="projecthubNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="projecthubNavbar">
                <div class="navbar-layout">
                    <div class="navbar-brand-spacer d-none d-lg-block"></div>

                    <ul class="navbar-nav navbar-center-nav align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link nav-action" href="{{ url('/dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-action" href="{{ url('/projects') }}">
                                <i class="bi bi-kanban me-2"></i>Projects
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-action" href="#users">
                                <i class="bi bi-people me-2"></i>Users
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-profile-wrap">
                        <div class="nav-item dropdown profile-dropdown">
                            <button class="nav-link dropdown-toggle profile-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <span class="profile-avatar-wrap">
                                    <img src="{{ $avatarUrl }}" alt="{{ $userName }}" class="profile-avatar">
                                </span>
                                <span class="profile-name">{{ $userName }}</span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end profile-menu">
                                <li>
                                    <a class="dropdown-item" href="#edit-profile">
                                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                                    </a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    @if (session('success'))
      <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast align-items-center bg-success text-white border-0"
     role="alert"
     data-bs-autohide="true"
     data-bs-delay="3000">
    <div class="toast-body">
        {{ session('success') }}
    </div>
</div>
      </div>
    @endif

    @if (session('error'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast align-items-center bg-danger text-white border-0"
         role="alert"
         data-bs-autohide="true"
         data-bs-delay="3000">
        <div class="toast-body">
            {{ session('error') }}
        </div>
    </div>
        </div>
    @endif
    
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toastElList = document.querySelectorAll('.toast');
    toastElList.forEach(toastEl => {
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
});
</script>
</body>

</html>