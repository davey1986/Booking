@if ($errors->any())
  <div>
    <ul style="list-style:none;">
        @foreach ($errors->all() as $error)
          <li class="alert alert-danger alert-dismissible fade show" role="alert" >{{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </li>
        @endforeach
    </ul>
  </div>
  <br />
@endif


@if(session()->has('status'))
<ul style="list-style:none;">
      <li class="alert alert-danger alert-dismissible fade show" role="alert" >{{session()->get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </li>
</ul>
@endif
