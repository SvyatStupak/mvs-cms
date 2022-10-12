<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Page id: <?= $page->id ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form method="POST" action="">
            <input type="hidden" name="action" value="1">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Page name</label>
                        <input type="text" name="title" class="form-control" value="<?= $page->title ?>" placeholder="Page name">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Textarea</label>
                        <textarea name="content" class="form-control" rows="3" placeholder="Page content"><?= $page->content ?></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>