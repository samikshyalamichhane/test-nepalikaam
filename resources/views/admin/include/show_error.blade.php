<div class="alert alert-danger alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
   <ul>
      @forelse ($errors->all() as $error)
      <li>{{ $error }}</li>
      @empty
      @endforelse
   </ul>
</div>