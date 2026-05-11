<?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}


// =========================
// AUTH CHECK
// =========================

function auth_check($roles = null)
{
    // =========================
    // USER NOT LOGGED IN
    // =========================

    if(!isset($_SESSION['member_id']))
    {
        $_SESSION['message'] =
            "Please login first";

        $_SESSION['message_type'] =
            "warning";

        header(
            "Location: /Library-Management-System/Project/login"
        );

        exit;
    }

    // =========================
    // ROLE CHECK
    // =========================

    if($roles !== null)
    {
        // Convert Single Role To Array

        if(!is_array($roles))
        {
            $roles = [$roles];
        }

        // Invalid Access

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

            // Redirect Based On Role

            switch($_SESSION['role'])
            {
                case 'admin':

                    header(
                        "Location: /Library-Management-System/Project/admin"
                    );

                    break;

                case 'librarian':

                    header(
                        "Location: /Library-Management-System/Project/librarian"
                    );

                    break;

                default:

                    header(
                        "Location: /Library-Management-System/Project/member"
                    );
            }

            exit;
        }
    }
}


// =========================
// CHECK LOGIN
// =========================

function is_logged_in()
{
    return isset($_SESSION['member_id']);
}


// =========================
// CHECK ROLE
// =========================

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