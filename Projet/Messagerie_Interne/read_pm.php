<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Lecture d'un MP</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
	    </div>
<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['username']))
{
//On verifie que lidentifiant de la discution est defini
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
//On recupere le titre et les narateurs de la discution
$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
//On verifie que la discution existe
if(mysql_num_rows($req1)==1)
{
//On verifie que lutilisateur a le droit dafficher les messages
if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
{
//La discution sera placee dans les messages lus
if($dn1['user1']==$_SESSION['userid'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
//On recupere la liste des messages
$req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, users.username, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
//On verifie si lutilisateur a valide le formulaire de reponse
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	//On enleve lechappement si get_magic_quotes_gpc est active
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	//On echape le message pour pouvoir le mettre dans une requette SQL
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	//On envoi la reponse et le statut de la discution passe a non-lu pour lautre utilisateur
	if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Votre message a bien &eacute;t&eacute; envoy&eacute;.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Retour &agrave; la discussion</a></div>
<?php
	}
	else
	{
?>
<div class="message">Une erreur c'est produite lors de l'envoi du message.<br />
<a href="read_pm.php?id=<?php echo $id; ?>">Retour &agrave; la discussion</a></div>
<?php
	}
}
else
{
//On affiche la liste des messages
?>
<div class="content">
<h1><?php echo $dn1['title']; ?></h1>
<table class="messages_table">
	<tr>
    	<th class="author">Utilisateur</th>
        <th>Message</th>
    </tr>
<?php
while($dn2 = mysql_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center"><?php
if($dn2['avatar']!='')
{
	echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
}
?><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
    	<td class="left"><div class="date">Date d'envoi: <?php echo date('d/m/Y H:i:s' ,$dn2['timestamp']); ?></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>
<?php
}
//On affiche le formulaire de reponse
?>
</table><br />
<h2>R&eacute;pondre</h2>
<div class="center">
    <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
    	<label for="message" class="center">Message</label><br />
        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
        <input type="submit" value="Envoyer" />
    </form>
</div>
</div>
<?php
}
}
else
{
	echo '<div class="message">Vous n\'avez pas le droit d\'acc&eacute;der &agrave; cette page.</div>';
}
}
else
{
	echo '<div class="message">Ce message n\'existe pas.</div>';
}
}
else
{
	echo '<div class="message">L\'identifiant du message n\'est pas d&eacute;fini.</div>';
}
}
else
{
	echo '<div class="message">Vous devez &ecirc;tre connect&eacute; pour acc&eacute;der &agrave; cette page.</div>';
}
?>
		<div class="foot"><a href="list_pm.php">Retour &agrave; mes messages priv&eacute;s</a> - <a href="http://www.supportduweb.com/">Support du Web</a></div>
	</body>
</html>