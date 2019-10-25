<script>
	$(document).ready( function () {
    @if(count($errors) > 0)
        @foreach ($errors->all() as $error)
            // <div class="alert  alert-danger col-sm-12">
            //         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            //     {{$error}}
            // </div>
            new PNotify({
                text: '{{ucfirst($error)}}',
                addclass: 'bg-danger border-primary'
            });

        @endforeach
    @endif

    @if (session('success'))
            // <div class="alert alert-success  col-sm-12" >
            //     {{session('success')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            // </div>
        new PNotify({
            text: '{{ucfirst(session('success'))}}',
            addclass: 'bg-success border-primary'
        });
    @endif

    @if (session('error'))
            // <div class="alert alert-danger  col-sm-12">
            //     {{session('error')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            // </div>   
            new PNotify({
                text: '{{ucfirst(session('error'))}}',
                addclass: 'bg-danger border-primary'
            }); 
    @endif
    });
</script>