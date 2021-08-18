import ReactDOM from 'react-dom';
import React from 'react';
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

const { Header, Content, Footer, Sider } = Layout;

if (document.getElementById('layout')) {
    ReactDOM.render(
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
                        nav 2
                    </Menu.Item>
                    <Menu.Item key="3" icon={<UploadOutlined />}>
                        nav 3
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
                    <h2>USER LIST</h2>
                </Header>
                <Content style={{ margin: '24px 16px 0', overflow: 'initial' }}>
                    <div className="site-layout-background" style={{ padding: 24, textAlign: 'center' }}>
                        {/* CHART AND USER INFORMATION */}
                        <div className='chartAndInfor'>
                            <div className='chartContainer'>
                                <h3 style={{ 'padding': '10px 0' }}>Users Statistic By Level</h3>
                                <ChartLevelCount></ChartLevelCount>
                            </div>

                            <div className='userInforContainer'>
                                <InforAndStatistic></InforAndStatistic>
                            </div>
                        </div>
                        <UserTable></UserTable>
                    </div>
                </Content>
                <Footer style={{ textAlign: 'center' }}>Ho Si Hung's Task</Footer>
            </Layout>
        </Layout>,
        document.getElementById('layout'),
    );
}