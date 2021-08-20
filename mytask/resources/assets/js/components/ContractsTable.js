import React, { useState, useEffect } from 'react';
import { Table, Popconfirm, message, Input, Space, Modal } from 'antd';
import { FaRegTrashAlt } from "react-icons/fa";
import { FaEdit } from "react-icons/fa";
import { FaRegFile } from "react-icons/fa";


function ContractsTable(props) {
    // SEARCH MENU
    const { Search } = Input;
    const onSearch = value => console.log(value);

    // MODAL BOX
    const [isModalVisible, setIsModalVisible] = useState(false);

    const showModal = () => {
        setIsModalVisible(true);
    };

    const handleOk = () => {
        setIsModalVisible(false);
    };

    const handleCancel = () => {
        setIsModalVisible(false);
    };

    //  CHART

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
            title: 'Buyer ID',
            dataIndex: 'id_buyer',
            sorter: {
                compare: (a, b) => a.id_buyer - b.id_buyer,
                multiple: 2,
            },
            ellipsis: true,
        },
        {
            title: 'Price',
            dataIndex: 'price',
            sorter: {
                compare: (a, b) => a.price - b.price,
                multiple: 3,
            },
            ellipsis: true,
        },
        {
            title: 'Payment Method',
            dataIndex: 'payment',
            sorter: {
                compare: (a, b) => a.payment - b.payment,
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
                <a className='btnEdit' title='Edit' href="#" data-id={`${id}`}><FaEdit></FaEdit></a>
            </div>
        },
    ];

    // confirm box
    async function confirm(id) {
        message.success('Delete Contracts Successfully');
    }

    function cancel(e) {
        console.log(e);
    }

    return (
        <div className='contractsTableContainer'>
            <div className='titleContainer'>
                <div title='Add Contract' onClick={showModal} className="iconHolder"><FaRegFile></FaRegFile></div>
                <Space direction="vertical">
                    <Search
                        placeholder="input search text"
                        allowClear
                        enterButton="Search"
                        size="large"
                        onSearch={onSearch}
                    />
                </Space>
            </div>
            <Table className='myUserTable' pagination={{ pageSize: 10 }} columns={columns} dataSource={props.contractsData} />
            <Modal title="Basic Modal" visible={isModalVisible} onOk={handleOk} onCancel={handleCancel}>
                <p>Some contents...</p>
                <p>Some contents...</p>
                <p>Some contents...</p>
            </Modal>
        </div>
    );
}

export default ContractsTable
