// import { Row, Col } from 'antd';
import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import { Table, Popconfirm, message } from 'antd';
import { FaRegTrashAlt } from "react-icons/fa";
import { FaEdit } from "react-icons/fa";

function UserTable() {
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            sorter: {
                compare: (a, b) => a.id - b.id,
                multiple: 1,
            },
        },
        {
            title: 'Name',
            dataIndex: 'name',
            sorter: {
                compare: (a, b) => a.name - b.name,
                multiple: 2,
            },
            ellipsis: true,
        },
        {
            title: 'Email',
            dataIndex: 'email',
            sorter: {
                compare: (a, b) => a.email - b.email,
                multiple: 3,
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
            dataIndex: 'id',
            render: (id) => <div>
                <Popconfirm
                    title="Are you sure to delete this task?"
                    onConfirm={() => { confirm(id) }}
                    onCancel={cancel}
                    okText="Yes"
                    cancelText="No"
                >
                    <a className='btnDelete' title='Delete' href="#"><FaRegTrashAlt></FaRegTrashAlt></a>
                </Popconfirm>
                <a className='btnEdit' onClick={() => { getUserInformationForEditing(id) }} title='Edit' href="#" data-id={`${id}`} data-toggle="modal" data-target="#modelEditUser"><FaEdit></FaEdit></a>
            </div>
        },
    ];

    // ACTUAL DATA
    const [dataUser, setDataUser] = useState([]);

    //FUNCTION TO SEND REQUEST TO GET ALL USER
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

        setDataUser(getData.data);
    }, []);
    console.log(dataUser)
    // FUNTION TO GET USER INFORMATION TO EDIT
    async function getUserInformationForEditing(id) {
        let dataResult = await sendInforRequest(id);

        let editID = document.querySelector('#editID');
        editID.value = dataResult.data.id;

        let editName = document.querySelector('#editName');
        editName.value = dataResult.data.name;

        let editEmail = document.querySelector('#editEmail');
        editEmail.value = dataResult.data.email;

        let editLevel = document.querySelector('#editLevel');
        editLevel.value = dataResult.data.level;
    }

    // FUNCTION TO SEND REQUEST TO GET INFORMATION OF USER
    async function sendInforRequest(id) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        const data = {
            id: id,
            _token: _token
        }

        const result = await fetch('/getInforUser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json;charset=UTF-8'
            },
            body: JSON.stringify(data)
        });

        return result.json();
    }

    // FUNTION TO GET USER INFORMATION TO EDIT
    async function deleteUser(id) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        const data = {
            id: id,
            _token: _token
        }

        const result = await fetch('/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json;charset=UTF-8'
            },
            body: JSON.stringify(data)
        });

        return result.json();
    }

    // confirm box
    async function confirm(id) {
        deleteUser(id);

        const getData = await sendRequest();

        setDataUser(getData.data);

        message.success('Delete User Successfully');
    }

    function cancel(e) {
        console.log(e);
    }

    return (
        <div>
            <Table className='myUserTable' pagination={{ pageSize: 10 }} columns={columns} dataSource={dataUser} />
        </div>
    );
}

export default UserTable;

// RENDER COMPONENT
if (document.getElementById('userTable')) {
    ReactDOM.render(<UserTable />, document.getElementById('userTable'));
}