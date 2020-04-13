<form method="POST" id="form" enctype="multipart/form-data" action="/edit">
    <div class="container">
        <h1>Text Editor</h1>
        <label>Text</label>
        <textarea name="text" id="text" class="form-control"><?php echo htmlspecialchars($data['text']); ?></textarea>
    </div>
    <div class="container">
        <label>Image</label>
        <input class="form-img" id="image" type="file" name="image" multiple="multiple">
    </div>
    <div class="container">
        <input type="submit" class="btn btn-success">
    </div>
    <div id="errors" class="container">

    </div>

</form>