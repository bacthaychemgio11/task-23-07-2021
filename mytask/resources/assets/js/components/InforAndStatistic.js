import React from 'react';
import CustomButton from './CustomButton';

function InforAndStatistic() {
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

                </div>
            </div>
        </div>
    )
}

export default InforAndStatistic
