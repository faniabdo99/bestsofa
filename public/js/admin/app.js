//Init TinyMCE
tinymce.init({
  selector: 'textarea.editor',
  plugins: 'advlist autolink lists link image charmap print preview anchor pagebreak media paste quickbars searchreplace',
  toolbar: 'h2 h3 | bold italic | bullist numlist |alignleft aligncenter alignright alignjustify | media quickimage | link | pastetext searchreplace',
  menubar: false,
  style_formats: [
    {title: 'Paragraph', block: 'p'},
    {title: 'Heading 2', format: 'h2'},
    {title: 'Heading 3', format: 'h3'},
    {title: 'Normal', block: 'div'}
    ]
});
function ShowNoto(className,text){
    //Create The Element
    $('body').append('<div class="noto"></div>');
    $('.noto').html(text).addClass(className).fadeIn('fast').delay(3000).fadeOut('fast');
}