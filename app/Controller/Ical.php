<?php

namespace Controller;

use Model\Task as TaskModel;

/**
 * iCalendar controller
 *
 * @package  controller
 * @author   Frederic Guillot
 */
class Ical extends Base
{
    /**
     * Get user calendar events
     *
     * @access public
     */
    public function user()
    {
        // TODO: protect by a token

        $user_id = $this->request->getIntegerParam('user_id');

        $start = strtotime('-1 month');
        $end = strtotime('+2 months');

        $this->response->contentType('text/calendar; charset=utf-8');

        echo $due_tasks = $this->taskFilter
            ->create()
            ->filterByOwner($user_id)
            ->filterByStatus(TaskModel::STATUS_OPEN)
            ->filterByDueDateRange($start, $end)
            ->toIcal();
    }
}
