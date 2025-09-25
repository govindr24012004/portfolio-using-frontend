<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  // Validate input
  if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all fields correctly.";
    exit;
  }

  // Receiver email
  $to = "govindarajanrsr@gmail.com"; // 🔁 உங்கள் email address
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n";
  $email_content .= "Subject: $subject\n\n";
  $email_content .= "Message:\n$message\n";

  // Send email
  if (mail($to, $subject, $email_content, $headers)) {
    http_response_code(200);
    echo "Your message has been sent. Thank you!";
  } else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission. Please try again.";
}
?>
