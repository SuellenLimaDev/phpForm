<?php
require 'PHPMailer/PHPMailerAutoload.php'; // Certifique-se de ter o PHPMailer na mesma pasta

// Dados do banco de dados
$servername = "mysql.escalaweb.com.br";
$username = "escalaweb16";
$password = "yf8ahqe4";
$dbname = "escalaweb16";

// Dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserção no banco de dados
$sql = "INSERT INTO Contatos (nome, email, telefone, mensagem) VALUES ('$nome', '$email', '$telefone', '$mensagem')";
$conn->query($sql);

// Envio do e-mail
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.escalaweb.com.br';
$mail->SMTPAuth = true;
$mail->Username = 'teste@escalaweb.com.br';
$mail->Password = 'yf8ah#qe4';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('teste@escalaweb.com.br', 'Contato do Site');
$mail->addAddress('seuemail@exemplo.com', 'Seu Nome');
$mail->Subject = 'Novo contato do site';
$mail->Body = "Nome: $nome\nEmail: $email\nTelefone: $telefone\nMensagem: $mensagem";

if(!$mail->send()) {
    echo 'Erro ao enviar e-mail.';
} else {
    echo 'E-mail enviado com sucesso.';
}

$conn->close();
?>
