<?php

namespace App\Application;

class Pagination
{
    private int $page = 1;
    private int $pageSize = 10;
    private int $offset = 0;

    private int $limit = 10;
    public function __construct(int $page = 1, int $pageSize = 10)
    {
        $this->setPage($page);
        $this->setPageSize($pageSize);
        $this->calculatePage();
    }

    /**
     * @param int $pageSize
     */
    private function setPageSize(int $pageSize): void
    {
        $this->pageSize = ($pageSize<=5)?10:$pageSize;
    }

    /**
     * @param int $page
     */
    private function setPage(int $page): void
    {
        $this->page = ($page<1)?1:$page;
    }
    private function calculatePage(): void {
        $page = $this->page;
        $pageSize = $this->pageSize;
        $this->limit = $pageSize;
        $this->offset = ($page-1)*$pageSize;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }


}
