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
            render: (actions) => (
                <div>
                    {actions.map((action) => {
                        if (action == 'delete') {
                            return (
                                <a className='btnDelete' title='Delete' key={{ action }} href="#"><FaRegTrashAlt></FaRegTrashAlt></a>
                            );
                        } else {
                            return (<a className='btnEdit' title='Edit' key={{ action }} href="#"><FaEdit></FaEdit></a>);
                        }
                    })}
                </div>
            )
        },
    ];

    // data demo
    const data = [
        {
            key: '1',
            id: '1',
            name: 'Hung',
            email: 'hung@gmail.com',
            level: 4,
            actions: ['delete', 'edit'],
        },
        {
            key: '2',
            id: '5',
            name: 'John',
            email: 'john@gmail.com',
            level: 0,
            actions: ['delete', 'edit'],
        },
        {
            key: '3',
            id: '15',
            name: 'Yum',
            email: 'yum@gmail.com',
            level: 1,
            actions: ['delete', 'edit'],
        },
        {
            key: '4',
            id: '25',
            name: 'Roar',
            email: 'roar@gmail.com',
            level: 3,
            actions: ['delete', 'edit'],
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
        // setDataUser(getData.data);

        setDataUser(data);
    }, []);
    console.log(dataUser)
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