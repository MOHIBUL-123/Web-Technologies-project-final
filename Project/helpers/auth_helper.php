<?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}




function auth_check($roles = null)
{




    if(!isset($_SESSION['member_id']))
    {
        $_SESSION['message'] =
            "Please login first";

        $_SESSION['message_type'] =
            "warning";

        header(
            "Location: /project/Web-Technologies-project-final/Project/login"
        );

        exit;
    }




    if($roles !== null)
    {


        if(!is_array($roles))
        {
            $roles = [$roles];
        }


        if(
            !in_array(
                $_SESSION['role'],
                $roles
            )
        )
        {
            $_SESSION['message'] =
                "Access Denied";

            $_SESSION['message_type'] =
                "error";


            switch($_SESSION['role'])
            {
                case 'admin':

                    header(
                        "Location: /project/Web-Technologies-project-final/Project/admin"
                    );

                    break;

                case 'librarian':

                    header(
                        "Location: /project/Web-Technologies-project-final/Project/librarian"
                    );

                    break;

                default:

                    header(
                        "Location: /project/Web-Technologies-project-final/Project/member"
                    );
            }

            exit;
        }
    }
}




function is_logged_in()
{
    return isset($_SESSION['member_id']);
}




function has_role($roles)
{
    if(!isset($_SESSION['role']))
    {
        return false;
    }

    if(!is_array($roles))
    {
        $roles = [$roles];
    }

    return in_array(
        $_SESSION['role'],
        $roles
    );
}