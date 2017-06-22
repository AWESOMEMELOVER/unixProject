 thumbnail: function("#my-awesome-dropzone") {
            var thumbnail = $('.dropzone .dz-preview.dz-file-preview');
            thumbnail.css('background', 'url('+dataUrl+')');
            var $fotoramaDiv = $('.fotorama').fotorama();
            var fotorama = $fotoramaDiv.data('fotorama');
            fotorama.push({img: dataUrl, thumb:dataUrl});   
                }

