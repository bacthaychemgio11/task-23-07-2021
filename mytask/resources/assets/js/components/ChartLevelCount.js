import React, { useState, useEffect } from 'react';
import { Bar } from '@ant-design/charts';

function ChartLevelCount() {
    // ACTUAL DATA
    const [dataChart, setDataChart] = useState([]);

    //FUNCTION TO SEND REQUEST TO GET ALL USER
    async function sendRequest() {

        const result = await fetch('/get-data-chart', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json;charset=UTF-8'
            },
        });

        return result.json();
    }

    useEffect(async () => {
        const getData = await sendRequest();
        setDataChart(getData.chartData);
    }, []);

    var config = {
        data: dataChart,
        xField: 'value',
        yField: 'level',
        seriesField: 'level',
    };

    return <Bar {...config} />;
}

export default ChartLevelCount;