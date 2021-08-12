// import { Row, Col } from 'antd';
import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { Table } from 'antd';
import { FaRegTrashAlt } from "react-icons/fa";
import { FaEdit } from "react-icons/fa";

function UserTable() {
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
        },
        {
            title: 'Name',
            dataIndex: 'name',
            sorter: {
                compare: (a, b) => a.name - b.name,
                multiple: 3,
            },
            ellipsis: true,
        },
        {
            title: 'Email',
            dataIndex: 'email',
            sorter: {
                compare: (a, b) => a.email - b.email,
                multiple: 2,
            },
            ellipsis: true,
        },
        {
            title: 'Level',
            dataIndex: 'level',
            sorter: {
                compare: (a, b) => a.level - b.level,
                multiple: 1,
            },
        },
        {
            title: 'Actions',
            dataIndex: 'actions',
            render: () => <div>
                <a className='btnDelete' title='Delete' href="#"><FaRegTrashAlt></FaRegTrashAlt></a>
                <a className='btnEdit' title='Edit' href="#"><FaEdit></FaEdit></a>
            </div>
        },
    ];

    // ACTUAL DATA
    const [dataUser, setDataUser] = useState([]);

    //FUNCTION TO SEND REQUEST
    async function sendRequest() {

        const result = await fetch('/get-users', {
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

        setDataUser(getData.data.data);
    }, []);
    // console.log(dataUser)

    return (
        <div>
            <Table className='myUserTable' columns={columns} dataSource={dataUser} />
        </div>
    );
}

export default UserTable;

// RENDER COMPONENT
if (document.getElementById('example')) {
    ReactDOM.render(<UserTable />, document.getElementById('example'));
}