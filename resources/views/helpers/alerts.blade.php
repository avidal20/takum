

@if (count($errors) > 0)
    <div class="alert bg-red alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
<div class="alert alert-success alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  @if(is_array(Session('success')))
      <ul>
          @foreach (Session('success') as $msg)
              <li>{{ $msg }}</li>
          @endforeach
      </ul>
  @else
      <ul>
        <li>{{ Session('success') }}</li>
      </ul>
  @endif
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  @if(is_array(Session('error')))
      <ul>
          @foreach (Session('error') as $msg)
              <li>{{ $msg }}</li>
          @endforeach
      </ul>
  @else
      <ul>
        <li>{{ Session('error') }}</li>
      </ul>
  @endif
</div>
@endif
