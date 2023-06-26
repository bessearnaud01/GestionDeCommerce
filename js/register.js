

  $(document).ready(function(){
  
    $('.field-input').focus(function(){
        $(this).parent().addClass('is-focused has-label');
    });

    // à la perte du focus
    $('.field-input').blur(function(){
        $parent = $(this).parent();
        if($(this).val() == ''){
            $parent.removeClass('has-label');
        }
        $parent.removeClass('is-focused');
    });


    // si un champs est rempli on rajoute directement la class has-label
    $('.field-input').each(function(){
        if($(this).val() != ''){
            $(this).parent().addClass('has-label');
        }
    });

    
    $('#regForm').submit(function(){

        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        
      
        var result = true;

        // le parent c'est la classe qui porte flied

        // On teste si nos champs sont remplit ou pas si elle n'est remplit parcontre s'elle n'est remplit  les label des champs et  les flied seront en rouge
        if(name == ""){
            $('#name').parent().addClass('is-focused error');
            result = false;
        }



        if(email == ""){
            $('#email').parent().addClass('is-focused error');
            result = false;
        }

        if(password == ""){
            $('#password').parent().addClass('is-focused error');
            result = false;
        }

        if(password_confirmation == ""){
            $('#password_confirmation').parent().addClass('is-focused error');
            result = false;
        }


        return result;

    });


// lorsqu'on champs sont remplit on veut il y a toujours la couleur rouge dans notre champs et de nos label donc veut enlever
//L' keyupévénement est envoyé à un élément lorsque l'utilisateur relâche une touche du clavier
                    
            $('#name').keyup(function(){
                if($('#name').val() == ''){
                    $('#name').parent().addClass('is-focused error');
                }else{
                    $('#name').parent().removeClass('error');
                }

            });

            $('#job').keyup(function(){
                if($('#job').val() == ''){
                    $('#job').parent().addClass('is-focused error');
                }else{
                    $('#job').parent().removeClass('error');
                }

            });








            $('#email').keyup(function(){
                if($('#email').val() == ''){
                    $('#email').parent().addClass('is-focused error'); // S'il est vide on aura une couleur rouge  et sinon on l'éfface la classe erreur
                }else{
                    $('#email').parent().removeClass('error');    
                }

            });
            $('#password').keyup(function(){
                if($('#password').val() == ''){
                    $('#password').parent().addClass('is-focused error');
                }else{
                    $('#password').parent().removeClass('error');
                }

            });


          $('#password_confirmation').keyup(function(){
                if($('#password_confirmation').val() == ''){
                    $('#password_confirmation').parent().addClass('is-focused error');
                }else{
                    $('#password').parent().removeClass('error');
                }

            });

 });
       


