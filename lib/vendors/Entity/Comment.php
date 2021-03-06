<?php
namespace Entity;

use \MiniFram\Entity;

class Comment extends Entity
{
    protected $chapter,
    $author,
    $content,
    $date,
    $reporting,
        $reportingDate;

    const AUTHOR_INVALID = 1;
    const CONTENT_INVALID = 2;

    public function isValid()
    {
        return !(empty($this->author) || empty($this->content));
    }

    public function setChapter($chapter)
    {
        $this->chapter = (int) $chapter;
    }

    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author)) {
            $this->erreurs[] = self::AUTHOR_INVALID;
        }

        $this->author = $author;
    }

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->erreurs[] = self::CONTENT_INVALID;
        }

        $this->content = $content;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    public function setReporting($reporting) // not useful for now cause we update it just in the DB call

    {
        $this->reporting = (int) $reporting;
    }

    public function setReportingDate(\DateTime $reportingDate)
    {
        $this->reportingDate = $reportingDate;
    }

    public function chapter()
    {
        return $this->chapter;
    }

    public function author()
    {
        return $this->author;
    }

    public function content()
    {
        return $this->content;
    }

    public function date()
    {
        return $this->date;
    }

    public function reporting()
    {
        return $this->reporting;
    }

    public function reportingDate()
    {
        return $this->reportingDate;
    }
}
