
// 2022-06-14 Prueba para ajustar tamaños de iframe con javascript
// En la página se pone
//    <script src="../varios/htmlcss.js"></script>
// y en el iframe se pone
//    onload="resizeIframe(this)"
// funciona pero tiene dos problemas
// - el tamaño del iframe no cambiar cuando se estrecha la ventana (salvo que se actualice la página)
// - si el fichero se abre como file:/// no apica el javascript por cross origin
//   da el error Uncaught DOMException: Permission denied to access property "document" on cross-origin object

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}

