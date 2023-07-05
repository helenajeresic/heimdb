<?php

require_once __SITE_PATH .  '/app/database/db.class.php';

seed_table_users();

function seed_table_users()
{
    $db = DB::getConnection();

    try
    {
	    $st = $db->prepare( 'INSERT INTO users(username, password_hash, email, registration_sequence, has_registered, is_admin, name, surname, date_of_birth, penalty ) VALUES
					  (:username, :password, :email, :rs, :hs, :ad, :name, :surname, :dat, :pen)' );

	    $st->execute( array( 'username' => 'kriza', 'password' => password_hash( 'Ikriza#1', PASSWORD_DEFAULT ),
            'email' =>'kriza@gmail.com', 'rs' =>'khgvfckvd', 'hs'=>'1', 'ad'=>'1', 'name'=>'Ivana', 'surname' => 'Krizanec',
            'dat' =>'1998-04-15', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'helejere', 'password' => password_hash( 'heleJ#12', PASSWORD_DEFAULT ),
            'email' =>'helejere@gmail.com', 'rs' =>'kkvvvcd', 'hs'=>'1', 'ad'=>'1', 'name'=>'Helena', 'surname' => 'Jeresic',
            'dat' =>'1999-12-02', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'elekova', 'password' => password_hash( 'eleKOV#1', PASSWORD_DEFAULT ),
            'email' =>'elekova@gmail.com', 'rs' =>'kkhjgfdvd', 'hs'=>'1', 'ad'=>'1', 'name'=>'Elena', 'surname' => 'Kovacek',
            'dat' =>'2000-08-12', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'koki_smoki', 'password' => password_hash( 'Tesla12?', PASSWORD_DEFAULT ),
            'email' =>'josip@gmail.com', 'rs' =>'kkvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Josip', 'surname' => 'Brekalo',
            'dat' =>'2000-04-19', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'frenchie', 'password' => password_hash( 'NekaLo56?', PASSWORD_DEFAULT ),
            'email' =>'tai.jack@gmail.com', 'rs' =>'kkfdvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Jack', 'surname' => 'Glass',
            'dat' =>'2000-09-17', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'spy123', 'password' => password_hash( 'KiKiKi0?', PASSWORD_DEFAULT ),
            'email' =>'spy123@gmail.com', 'rs' =>'kksdvdsd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Jane', 'surname' => 'Black',
            'dat' =>'2004-01-19', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'lopezica', 'password' => password_hash( 'hia3ZT-8', PASSWORD_DEFAULT ),
            'email' =>'lopez@gmail.com', 'rs' =>'kkdssgvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Mary', 'surname' => 'Lopez',
            'dat' =>'1999-04-10', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'gameMaster', 'password' => password_hash( 'misteryBo89-', PASSWORD_DEFAULT ),
            'email' =>'game123@gmail.com', 'rs' =>'cfthkkvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Evan', 'surname' => 'Jonas',
            'dat' =>'2001-03-11', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'operaLover', 'password' => password_hash( 'opsus-P21', PASSWORD_DEFAULT ),
            'email' =>'traviata@gmail.com', 'rs' =>'kgfgjckvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Melissa', 'surname' => 'Evans',
            'dat' =>'1985-04-04', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'eureka12', 'password' => password_hash( 'zgcityZG5-', PASSWORD_DEFAULT ),
            'email' =>'eva@gmail.com', 'rs' =>'kkvfghjd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Eva', 'surname' => 'Max',
            'dat' =>'1998-07-13', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'marsP', 'password' => password_hash( 'marsovacL0-', PASSWORD_DEFAULT ),
            'email' =>'mArs@gmail.com', 'rs' =>'kgrfzjkvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Tyler', 'surname' => 'Smith',
            'dat' =>'2000-01-01', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'cloud9', 'password' => password_hash( 'oblakKisa15!', PASSWORD_DEFAULT ),
            'email' =>'cloud@gmail.com', 'rs' =>'kkfdgfffffvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Christina', 'surname' => 'Brown',
            'dat' =>'2003-09-19', 'pen' => '0' ) );
	    $st->execute( array( 'username' => 'mermaidsAreReal', 'password' => password_hash( 'mmmm11S-1', PASSWORD_DEFAULT ),
            'email' =>'mermaidLover@gmail.com', 'rs' =>'gjzgfkkvd', 'hs'=>'1', 'ad'=>'0', 'name'=>'Thomas', 'surname' => 'Williams',
            'dat' =>'1995-08-16', 'pen' => '0' ) );
    }
    catch( PDOException $e ) { exit( "PDO error [insert users]: " . $e->getMessage() ); }

    echo "Ubacio u tablicu users.<br />";
}

?>
