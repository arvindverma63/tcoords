<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}">
</head>

<body>
    @include('partials.navbar')


    <section class="hero" id="hero">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-2 fw-bold"><img src="{{asset('images/logo/logo-removebg-preview.png')}}" height="90px;"></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum laoreet finibus. Sed porta
                        lobortis metus sed commodo. Fusce convallis vestibulum velit, id imperdiet metus faucibus nec.
                    </p>
                    <button class="btn btn-outline-dark btn-lg">Projects</button>
                </div>
                <div class="col-sm-6 text-center">
                    <img src="https://codingyaar.com/wp-content/uploads/barista.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <h2 class="display-5 fw-bold mb-4">Services</h2>
            <div class="row">
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <i class="bi bi-cup-hot-fill"></i>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <i class="bi bi-cup-hot-fill"></i>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 m-auto mt-4">
                    <div class="card">
                        <i class="bi bi-cup-hot-fill"></i>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container">
            <h2 class="display-5 fw-bold mb-4">About Me</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed interdum est id pulvinar mollis. Nullam
                rhoncus dignissim ipsum, ac pulvinar tellus sodales ut. Vestibulum tincidunt malesuada consectetur.
                Nulla vel fermentum leo. Mauris rhoncus blandit justo, at congue dui rhoncus sit amet.</p>
            <p>Proin molestie
                sapien vel nulla accumsan, sit amet viverra metus ornare. Mauris iaculis ex vitae mollis pulvinar.
                Phasellus fringilla neque sed ligula lacinia iaculis.</p>
        </div>
    </section>

    <section class="projects" id="projects">
        <div class="container">
            <h2 class="display-5 fw-bold mb-4">Projects</h2>
            <div class="row">
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <img src="https://codingyaar.com/wp-content/uploads/image-plcaeholder.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-outline-dark">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <img src="https://codingyaar.com/wp-content/uploads/image-plcaeholder.png" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-outline-dark">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <img src="https://codingyaar.com/wp-content/uploads/image-plcaeholder.png"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-outline-dark">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 mt-4">
                    <div class="card">
                        <img src="https://codingyaar.com/wp-content/uploads/image-plcaeholder.png"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-outline-dark">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@include('partials.footer')
    @include('partials.js')

</html>
