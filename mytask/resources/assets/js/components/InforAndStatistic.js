import React from 'react';
import CustomButton from './CustomButton';
import { DollarCircleFilled } from '@ant-design/icons';

function InforAndStatistic(props) {
    return (
        <div>
            <div className='titleContainer'>
                <CustomButton active='yes' content='Your Information'></CustomButton>
                <CustomButton content='Your Sales'></CustomButton>
            </div>

            <div className='inforContainer'>
                <div className='inforContainerDecoration'></div>
                <div className='inforContainerDecoration'></div>
                <div className='inforContainerDecoration'></div>

                <div className='inforCard'>
                    <div className='frontFace'>
                        <div className='inforCardDeco1'></div>
                        <div className='website'>
                            <h4>Invest</h4>
                            www.invest.com
                            <br />
                            info@invest.com
                        </div>
                        <div className='logo'><DollarCircleFilled /></div>
                        <div className='name longText'>{props.userInfor.name}</div>
                    </div>

                    <div className='backFace'>
                        <div className='title'>
                            <div className='titleLeft'>
                                <h3 className='customerName longText'>{props.userInfor.name}</h3>
                                <div className='greenTitle'>Member</div>
                            </div>

                            <div className='titleRight'>
                                <div className='logo'><DollarCircleFilled /></div>
                            </div>
                        </div>

                        <div className='infor'>
                            Level: {props.userInfor.level}
                            <br />
                            {props.userInfor.email}
                            <br />
                            19/22 McKensy Street, John North
                            <br />
                            Vic 3212, Vienna, Austrlia
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default InforAndStatistic
