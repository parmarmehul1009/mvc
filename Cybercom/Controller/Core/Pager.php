<?php

namespace Controller\Core;

class Pager
{
    protected $totalRecord = null;
    protected $recordsPerPage = null;
    protected $noOfPages = null;
    protected $start = 1;
    protected $end = null;
    protected $previous = null;
    protected $next = null;
    protected $currentPage = null;

    public function setTotalRecord($totalRecord = null)
    {
        $this->totalRecord  = (int)$totalRecord;
        return $this;
    }

    public function getTotalRecord()
    {
        return $this->totalRecord;
    }

    public function setRecordsPerPage($recordsPerPage)
    {
        $this->recordsPerPage  = (int)$recordsPerPage;
        return $this;
    }

    public function getRecordsPerPage()
    {
        return $this->recordsPerPage;
    }

    public function setNoOfPages($noOfPages = null)
    {
        $this->noOfPages  = (int)$noOfPages;
        return $this;
    }

    public function getNoOfPages()
    {
        return $this->noOfPages;
    }

    protected function setStart($start = null)
    {
        $this->start  = $start;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    protected function setEnd($end = null)
    {
        $this->end  = $end;
        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    protected function setNext($next = null)
    {
        $this->next  = $next;
        return $this;
    }

    public function getNext()
    {
        return $this->next;
    }

    protected function setPrevious($previous = null)
    {
        $this->previous  = $previous;
        return $this;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setCurrentPage($currentPage = null)
    {
        $this->currentPage  = (int)$currentPage;
        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function calculate()
    {
        if ($this->getTotalRecord() <= $this->getRecordsPerPage()) {
            $this->setNoOfPages(1);
            $this->setPrevious(null);
            $this->setNext(null);
            $this->setEnd(null);
            return $this;
        }
        $page = ceil($this->getTotalRecord() / $this->getRecordsPerPage());
        $this->setNoOfPages($page);
        $this->setEnd($page);

        if ($this->getCurrentPage() > $this->getNoOfPages()) {
            $this->setCurrentPage($this->getNoOfPages());
        }

        if ($this->getCurrentPage() < $this->getStart()) {
            $this->setCurrentPage($this->getStart());
        }

        if ($this->getCurrentPage() == $this->getStart()) {
            $this->setPrevious(null);
            $this->setStart(null);
            if ($this->getCurrentPage() <= $this->getNoOfPages()) {
                $this->setNext($this->getCurrentPage() + 1);
            }
            return $this;
        }

        if ($this->getCurrentPage() == $this->getEnd()) {
            $this->setNext(null);
            $this->setEnd(null);
            if ($this->getCurrentPage() >= $this->getNoOfPages()) {
                $this->setPrevious($this->getCurrentPage() - 1);
            }
            return $this;
        }

        if ($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd()) {
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);
        }

        return $this;
    }
}
