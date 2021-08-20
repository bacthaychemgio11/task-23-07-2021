import ReactDOM from 'react-dom';
import React, { useState, useEffect } from 'react';
import { Layout, Menu } from 'antd';
import {
    AppstoreOutlined,
    BarChartOutlined,
    CloudOutlined,
    ShopOutlined,
    TeamOutlined,
    UserOutlined,
    UploadOutlined,
    VideoCameraOutlined,
} from '@ant-design/icons';
import UserTable from './UserTable.js';
import ChartLevelCount from './ChartLevelCount.js';
import InforAndStatistic from './InforAndStatistic.js';
import ContractsTable from './ContractsTable.js';

const { Header, Content, Footer, Sider } = Layout;


function CustomLayout() {
    const tableName = ['users', 'contracts'];
    // ACTUAL DATA
    const [dataChart, setDataChart] = useState([]);
    const [dataUser, setDataUser] = useState([]);
    const [dataContracts, setDataContracts] = useState([]);
    const [tableDisplay, setTableDisplay] = useState(tableName[0]);

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

    // FUNCTION TO GET ALL CONTRACTS OF USERS
    async function getAllContractsOfUser() {
        const result = await fetch('/get-contracts-user', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json;charset=UTF-8'
            },
        });

        return result.json();
    }

    // FUNCTION TO CHANGE DISPLAY TABLE
    function setDisplayTable(name) {
        setTableDisplay(name);
    }

    function renderTable(name) {
        switch (name) {
            case tableName[0]:
                return <UserTable></UserTable>;
                break;
            case tableName[1]:
                return <ContractsTable contractsData={dataContracts}></ContractsTable>
                break;
            default:
                break;
        }
    }

    useEffect(async () => {
        const getData = await sendRequest();
        setDataChart(getData.chartData);
        setDataUser(getData.userInfo);

        const contractsOfUser = await getAllContractsOfUser()
        setDataContracts(contractsOfUser.dataContracts);
        console.log(dataContracts);
    }, []);

    return (
        <Layout>
            <Sider
                style={{
                    overflow: 'auto',
                    height: '100vh',
                    position: 'fixed',
                    left: 0,
                }}
            >
                <div className="logo"></div>
                <Menu mode="inline" defaultSelectedKeys={['1']}>
                    <Menu.Item key="1" icon={<UserOutlined />}>
                        <a href="#" data-toggle="modal" data-target="#modelAddUser">Add new user</a>
                    </Menu.Item>
                    <Menu.Item key="2" icon={<VideoCameraOutlined />}>
                        <a href="#" onClick={() => { setDisplayTable(tableName[0]) }}>Users List</a>
                    </Menu.Item>
                    <Menu.Item key="3" icon={<UploadOutlined />}>
                        <a href="#" onClick={() => { setDisplayTable(tableName[1]) }}>Your Contracts</a>
                    </Menu.Item>
                    <Menu.Item key="4" icon={<BarChartOutlined />}>
                        nav 4
                    </Menu.Item>
                    <Menu.Item key="5" icon={<CloudOutlined />}>
                        nav 5
                    </Menu.Item>
                    <Menu.Item key="6" icon={<AppstoreOutlined />}>
                        nav 6
                    </Menu.Item>
                    <Menu.Item key="7" icon={<TeamOutlined />}>
                        nav 7
                    </Menu.Item>
                    <Menu.Item key="8" icon={<ShopOutlined />}>
                        nav 8
                    </Menu.Item>
                </Menu>
            </Sider>
            <Layout className="site-layout" style={{ marginLeft: 200 }}>
                <Header className="site-layout-background" style={{ padding: 0 }}>
                    <h2>INVEST.COM</h2>
                </Header>
                <Content style={{ margin: '24px 16px 0', overflow: 'initial' }}>
                    <div className="site-layout-background" style={{ padding: 24, textAlign: 'center' }}>
                        {/* CHART AND USER INFORMATION */}
                        <div className='chartAndInfor'>
                            <div className='chartContainer'>
                                <h3 style={{ 'padding': '10px 0' }}>Users Statistic By Level</h3>
                                <ChartLevelCount dataChart={dataChart}></ChartLevelCount>
                            </div>

                            <div className='userInforContainer'>
                                <InforAndStatistic userInfor={dataUser}></InforAndStatistic>
                            </div>
                        </div>
                        {renderTable(tableDisplay)}
                    </div>
                </Content>
                <Footer style={{ textAlign: 'center' }}>Ho Si Hung's Task</Footer>
            </Layout>
        </Layout>
    )
}

export default CustomLayout

if (document.getElementById('layout')) {
    ReactDOM.render(
        <CustomLayout></CustomLayout>
        ,
        document.getElementById('layout'),
    );
}