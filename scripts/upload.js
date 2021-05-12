$(function() {
    console.log('test');
    var reader = {};
    var file = {};
    var slice_size = 500 * 500; // Taille de chaque segment



    document.querySelector("#uploadOeuvre").onchange = function start_upload(event) {


        event.preventDefault();

        reader = new FileReader();
        file = document.querySelector('#uploadOeuvre').files[0];

        upload_file(0);

      };
    

    function upload_file(start) {
        var next_slice = start + slice_size + 1;
        var blob = file.slice(start, next_slice); // on ne voudra lire qu'un segment du fichier
        console.log('test segment');

        document.getElementById("spinner-danger").style.display = "inherit"; 

        reader.onloadend = function (event) { // fonction à exécuter lorsque le segment a fini d'être lu
            if (event.target.readyState !== FileReader.DONE) {
                return;
            }

            $.ajax({
                url: "../scripts/Fileupload.php",
                type: 'POST',
                cache: false,
                data: {
                    file_data: event.target.result,
                    file: file.name
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                },
                success: function(data) {
                    var size_done = start + slice_size;
                    var percent_done = Math.floor((size_done / file.size) * 100);

                    if (next_slice < file.size) {
                        $('#upload-progress').html('Uploading File - ' + percent_done + '%');

                        upload_file(next_slice); // s'il reste à lire, on appelle récursivement la fonction
                        console.log("en cours")
                    } else {
                        $('#upload-progress').html('Upload Complete!');
                        document.getElementById("spinner-danger").style.display = "none"; 
                        console.log('Upload Complete!');

                      
                            $.ajax({
                            type: "POST",
                            url: "../scripts/upload.php",
                            data: {
                                file_data: event.target.result,
                                file: file.name
                            },
                           })



                    }
                    
                }
            });
        };

        reader.readAsDataURL(blob); // lecture du segment
    }
});




