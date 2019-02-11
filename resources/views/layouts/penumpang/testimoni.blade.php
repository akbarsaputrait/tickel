<form class="form-horizontal" action="{{ (is_null($testimoni)) ? route('penumpang.testimoni.store') : route('penumpang.testimoni.update', ['id' => $testimoni->id]) }}" method="post">
  @csrf
  <div class="row">
    <div class="col-md-12">
			<div class="form-group">
				<label for="">Testimoni Pelanggan</label>
				<textarea name="content" class="form-control" rows="8" cols="80">{{ (is_null($testimoni)) ? '' : $testimoni->content }}</textarea>
			</div>
			<div class="form-group d-flex justify-content-end">
				<button type="submit" class="btn btn-primary-custom" name="button">Simpan</button>
			</div>
    </div>
  </div>
</form>
