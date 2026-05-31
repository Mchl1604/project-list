@extends('layouts.userApp')

@section('title', 'Users')

@section('content')
  <div class="row mt-4">
    <div class="col-12 col-md-4">
      <div class="card mb-4">
        <div class="card-body text-center">
          <img src="{{ $user->profile_image ? asset($user->profile_image) : asset('profileImage/defaultProfile.jpg') }}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;">
          <form method="POST" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 text-start">
              <label for="profileImage" class="form-label">Change Profile Picture</label>
              <input type="file" class="form-control" id="profileImage" name="profile_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success w-100">Save Profile Picture</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-8">
      <div class="card mb-4">
        <div class="card-body">
          <h5 class="card-title green-font">Edit Profile Information</h5>
          <form method="POST" action="{{ route('profile.information.update') }}">
            @csrf
            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
              </div>
            </div>

            <h5 class="mt-4 green-font">Change Password</h5>
            <div class="mb-3">
              <label for="oldPassword" class="form-label">Old Password</label>
              <input type="password" class="form-control" id="oldPassword" name="old_password">
            </div>

            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="new_password">
              </div>
              <div class="col-12 col-md-6 mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation">
              </div>
            </div>

            <button type="submit" class="btn btn-success w-100">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script>
document.getElementById('profileImage').addEventListener('change', function (e) {
    const file = e.target.files[0];

    const reader = new FileReader();

    reader.onload = function () {
        document.getElementById('profileImageBase64').value = reader.result;
    };

    reader.readAsDataURL(file);
});
</script>
@endsection
