import React from 'react';
import { Bar } from '@ant-design/charts';

function ChartLevelCount(props) {
    var config = {
        data: props.dataChart,
        xField: 'value',
        yField: 'level',
        seriesField: 'level',
    };

    return <Bar {...config} />;
}

export default ChartLevelCount;