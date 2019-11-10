<!-- Modal -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ session('alert') }}
      </div>
      <div class="modal-footer justify-content-center">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendido.</button> --}}
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok.</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(window).on('load',function(){        
    $('#alert').modal('show');
  }); 
</script>