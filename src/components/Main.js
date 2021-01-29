import React, { Component } from 'react';
import '@atlaskit/css-reset';
import styled from 'styled-components';
import { DragDropContext, Droppable } from 'react-beautiful-dnd';
import initialData from './initial-data';
import Column from './column';
import Product from './product';
import PlaceOrderButton from './PlaceOrderButton';
import Spinner from '../assets/spinner.gif';

const BodyBlock = styled.div`
    background-color: #F4F4F4;
    margin: 0;
    padding: 0 0 20px;
    width: 100%;
    display: table;
`;
const MainTitle = styled.h3`
    text-align: center;
    padding: 20px 0;
    font-size: 25px;
    border-bottom: 1px solid #ddd;
    text-transform: uppercase;
    margin: 0 0 10px;
`;
const WeekDaysContainer = styled.div`
    display: table;
    margin: 20px auto 0;
    width: 100%;
    max-width: 900px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
`;
const WeekDaysBlock = styled.div`
    display: flex;
    flex-direction: row;
    justify-content: center;
`;
const OrderInfo = styled.div`
    border-top: 1px solid #ddd;
    padding: 10px;
    font-weight: bold;
    font-size: 16px;
    text-align: right;
`;
const ProductsBlock = styled.div`
    display: table;
    margin: 35px auto 0;
    border-radius: 5px;
    min-width: 632px;
    background-color: #FFF;
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
`;
const Title = styled.h3`
    padding: 8px;
`;
const ProductList = styled.div`
    padding: 8px;
`;
const PlaceOrder = styled.div`
    display: table;
    margin: 30px auto 0;
    padding: 10px;
    width: 100%;
    max-width: 350px;
    color: #fff;
    background-color: #476B2D;
    text-align: center;
    text-transform: uppercase;
    font-size: 17px;
    border-radius: 5px;
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.15);
`;

export default class Main extends Component {
    state = initialData;


    componentDidMount() {

        fetch("https://localhost/wp-json/wc/v2/products/11?consumer_key="+ this.state.consumer_key +"&consumer_secret=" + this.state.consumer_secret)
            .then(res => res.json())
                .then(
                    (mainResult) => {
                        var APIIds = mainResult.grouped_products;
                        
                        APIIds.map((productID) => {
                            return fetch("https://localhost/wp-json/wc/v2/products/"+ productID +"?consumer_key="+ this.state.consumer_key +"&consumer_secret=" + this.state.consumer_secret)
                                .then(res => res.json())
                                    .then(
                                        (result) => {
                                            const id = result.id;
                                            const content = result.images[0].src;
                                            const price = result.price;

                                            // updating the state
                                            const newProds = {
                                                ...this.state,
                                                isLoaded: Object.keys(this.state.products).length === APIIds.length - 1 ? true : false,
                                                products: {
                                                    ...this.state.products,
                                                    [id]:{
                                                        ...this.state.products[id],
                                                        id: JSON.stringify(id),
                                                        content: content,
                                                        price: price
                                                    }
                                                },
                                                productsColumn: {
                                                    ...this.state.productsColumn,
                                                    products: {
                                                        ...this.state.productsColumn.products,
                                                        productIds: mainResult.grouped_products.map(String)
                                                    }
                                                }
                                            };
                                            this.setState(newProds);
                                        },
                                        (error) => {
                                            this.setState({
                                                isLoaded: false,
                                                error
                                            });
                                        }
                                    );
                            
                        });

                    },
                    (error) => {
                        this.setState({
                            isLoaded: false,
                            error
                        });
                    }
                )
        
    
    }

    onDragEnd = result => {
        
        const { destination, source, draggableId } = result;
        // console.log(destination);
        if(!destination || destination.droppableId === 'products'){
            return;
        }

        if(
            destination.droppableId === source.droppableId &&
            destination.index === source.index
        ) {
            return;
        }

        const start = source.droppableId === 'products' ?
                this.state.productsColumn[source.droppableId] : 
                this.state.days[source.droppableId];
        const finish = this.state.days[destination.droppableId];
        
        // moving from one list to another
        const startProductIds = Array.from(
            source.droppableId === 'products' ? 
            start.productIds : start.productIds);
        
            startProductIds.splice(source.index, 1);
        const newStart = {
            ...start,
            productIds: startProductIds,
        };        

        const finishProductIds = Array.from(finish.productIds);

        finishProductIds.splice(destination.index, 0, draggableId);
        const newFinish = {
            ...finish,
            productIds: finishProductIds,
        };

        // removing the item from products state
        if(source.droppableId === 'products'){
            const newpIDs = this.state.productsColumn.products.productIds;
            const prodRemove = draggableId;
            const remIndex = newpIDs.indexOf(prodRemove);
            newpIDs.splice(remIndex, 1);
        }
        
        // updating total price
        const currentItemPrice = 
        source.droppableId === 'products' ? 
        this.state.products[draggableId].price : 0;

        const newState = {
            ...this.state,
            totalPrice: parseInt(currentItemPrice) + parseInt(this.state.totalPrice),
            days: {
                ...this.state.days,
                [newStart.id]: newStart,
                [newFinish.id]: newFinish
            },
            productsColumn: {
                ...this.state.productsColumn,
            }
        };
        this.setState(newState);
    }

    render(){
        
        let totalPrice = this.state.totalPrice;

        const orderDone = this.state.productsColumn.products.productIds.length !== 0 ? true : false;
        // const disablePersonalization = !orderDone ? "'pointerEvents':'none'" : '';
        return (
            <>
            {this.state.isLoaded ? 
            (<BodyBlock>
                <DragDropContext onDragEnd={this.onDragEnd}>
                    <WeekDaysContainer style={{'pointerEvents': !orderDone ? 'none' : ''}}>
                        <MainTitle>Personalize Your Order</MainTitle>
                        <WeekDaysBlock>
                            {this.state.daysOrder.map((dayId) => {
                                const day = this.state.days[dayId];
                                const products = day.productIds.map(productId => this.state.products[productId]);
                                
                                return <Column key={day.id} day={day} products={products} />;
                            })}
                        </WeekDaysBlock>
                        <OrderInfo>
                        <p>Total: ${totalPrice}</p>
                        </OrderInfo>
                    </WeekDaysContainer>
            
                    {orderDone ? 
                        (<ProductsBlock>
                            <Title>{this.state.productsColumn.products.title}</Title>
                            <Droppable droppableId={this.state.productsColumn.products.id}>
                                {(provided) => (
                                    <ProductList
                                        ref={provided.innerRef}
                                        {...provided.droppableProps}
                                    >
                                        {this.state.productsColumn.products.productIds.map((product, index) => 
                                            <Product key={product} product={this.state.products[product]} index={index} />
                                        )}
                                        {provided.placeholder}
                                    </ProductList>
                                )}
                            </Droppable>
                        </ProductsBlock>) : 
                        <PlaceOrder>
                            <PlaceOrderButton
                                days={this.state.days}
                            />
                        </PlaceOrder>
                    }
                </DragDropContext>
            </BodyBlock>) : <img src={Spinner} style={{'width': '100px','display':'table','margin':'0 auto'}} alt="Spinner" />}
            </>
        )
    }
}