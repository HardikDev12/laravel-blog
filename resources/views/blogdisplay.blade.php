<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Blogs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Latest Blogs</h1>
        <div class="row">
            <!-- Start of blog cards loop -->
            
            @foreach($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/images/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->description }}</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Start Date: {{ $blog->startdate }}</small>
                            <br>
                            <small class="text-muted">End Date: {{ $blog->enddate }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- End of blog cards loop -->
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
