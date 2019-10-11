<?php

namespace Output;

use Input\ReportInput;

/**
 * Class ReportOutput
 * @package Output
 */
class ReportOutput
{
    /**
     * @param ReportInput $input
     * @return string
     */
    public function printParseResult(ReportInput $input)
    {
        $total = $input->getParseResult();
        return 'Parsed pages - '. $total['total_urls'].
            PHP_EOL. 'Find total images - '. $total['total_img'].
            PHP_EOL. 'Find unique images - '. $total['unique_img'];
    }
}