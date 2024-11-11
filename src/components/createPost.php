<dialog data-model id="createPost" style="width: 50%; height: 70vh;">
  <div id="uploadNewPost"> 
    <div class="image-preview" id="uploadImage">
      <img id="preview-image"/>
      <div class="upload-icon"><img src="../../assets/icons/upload.png" /></div>
    </div>

    <div class="form-section">
      <input type="text" id="caption" placeholder="Add a Caption">
      <a id="create-post">Create New Post</a>
      <input type="file" id="image-input" accept="image/*" style="display: none;">
    </div>
  </div>
</dialog>
