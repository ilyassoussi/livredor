<?php
    if(!empty($_FILES['image']))
    {
        
        $nameFile = $_FILES['image']['name'];
        $typeFile = $_FILES['image']['type'];
        $sizeFile = $_FILES['image']['size'];
        $tmpFile = $_FILES['image']['tmp_name'];
        $errFile = $_FILES['image']['error'];
        
        // Extensions
        $extensions = ['png', 'jpg', 'jpeg', 'gif'];
        // Type d'image
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
        // On récupère
        $extension = explode('.', $nameFile);
        // Max size
        $max_size = 100000;


        // On vérifie que le type est autorisés
        if(in_array($typeFile, $type))
        {
            // On vérifie que il n'y a que deux extensions
            if(count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions))
            {
                // On vérifie le poids de l'image
                if($sizeFile < $max_size && getimagesize($nameFile))
                {
                    // On bouge l'image uploadé dans le dossier upload
                if (move_uploaded_file($tmpFile, './uploadimg/img' . uniqid() . '.' . strtolower(end($extension))))
                    header('location:./index.php');
                        echo "failed";
                }
                else 
                {
                    echo "Fichier trop lourd ou format incorrect";
                }
            }
            else 
            {
                echo "Extension failed";
            }
        }   
        else 
        {
            echo "Type non autorisé";
        }


    }
    else 
    {
        header('Location: index.php');
        die();
    }
    ?>