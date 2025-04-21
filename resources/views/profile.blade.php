<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        .img-account-profile {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 2px solid #ccc;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        #imagePreview:hover {
            opacity: 0.8;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .loader {
            border: 10px solid #f3f3f3;
            border-radius: 50%;
            border-top: 10px solid #3498db;
            width: 50px;
            height: 50px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="{{ route('home') }}">Home</a>
            <!-- <a class="nav-link active ms-0" href="{{ route('profile') }}" target="__blank">Profile</a> -->
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        @php
                        if($user->image != null){
                        $image = $user->image;
                        }else{
                        $image = "http://bootdey.com/img/Content/avatar/avatar1.png";
                        }
                        @endphp
                        <img class="img-account-profile rounded-circle mb-2" id="imagePreview" src="{{$image}}" alt="">
                        <!-- <div class="loader"></div> -->
                        <!-- <div class="small font-italic text-muted mb-4"></div> -->
                        <button class="btn btn-primary" type="button" id="btn_upload">Upload new image  <i class="fa fa-spinner fa-spin"></i></button>
                        <input class="btn btn-primary" hidden type="file" id="fileInput" name="image" value="Upload Image">
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form id="profileForm" enctype="multipart/form-data">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Name</label>
                                <input class="form-control" id="inputUsername" type="text" name="name" placeholder="Enter your name" value="{{ $user->name }}">
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (organization name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Country</label>
                                    <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" name="country" value="{{ $user->country }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="gender">Gender</label><br><br>
                                    <input type="radio" name="gender" id="male" value="{{MALE}}" {{ $user->gender == MALE ? 'checked' : '' }}><label class="ms-2" for="male">Male</label>
                                    <input type="radio" name="gender" id="female" value="{{FEMALE}}" {{ $user->gender == FEMALE ? 'checked' : '' }} class="ms-3"><label class="ms-2" for="female">Female</label>
                                    <!-- <input class="form-control" id="gender" type="text" placeholder="Enter your Gender" name="gender" value=""> -->
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" name="email" value="{{ $user->email }}">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" name="phone" type="tel" placeholder="Enter your phone number" value="{{ $user->phone }}">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Date of Birth</label>
                                    <input class="form-control" id="inputBirthday" type="date" name="date_of_birth" placeholder="Enter your birthday" value="{{ $user->date_of_birth }}">
                                </div>
                            </div>
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="button" id="btnSubmit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn_upload').click(function() {
                $('#fileInput').click();
            });

            $('#fileInput').change(function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        submit(file);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $("#btnSubmit").on("click" , function(){
                submit();
            })
            function submit(file = null) {
                const formData = new FormData($('#profileForm')[0]);
                if (file) {
                    formData.set('image', file); // safe image replacement
                }

                $.ajax({
                    url: "{{ route('profile_update') }}",
                    type: 'POST',
                    data: formData,
                    processData: false, // important!
                    contentType: false, // important!
                    success: function(response) {
                        console.log(response);
                        if(response.success){
                            if (!file) {
                                Swal.fire("Success" , response.message , "success" , 'top-end');
                            }
                            $('#imagePreview').attr('src', response.image);
                        }
                    },
                    error: function(error) {
                        // console.error(xhr.responseText);
                        console.log("error", error);
                    }
                });
            }

        });
    </script>
</body>

</html>