<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/theme.css" rel="stylesheet">

</head>
<body>
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