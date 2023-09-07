<?php

namespace App\Entities;

class Message
{
  private $message_id;
  private $sender_id;
  private $receiver_id;
  private $content;
  private $created_at;

  /**
   * Get the value of message_id
   */
  public function getMessageId()
  {
    return $this->message_id;
  }

  /**
   * Set the value of message_id
   */
  public function setMessageId($message_id): self
  {
    $this->message_id = $message_id;

    return $this;
  }
}
