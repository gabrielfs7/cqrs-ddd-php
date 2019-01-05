fromCategory(':fromStream')
.foreachStream()
.when(
    {
        $init: function() {
            return {
                total: 0,
                data: []
            }
        },
        OrderCreated: function(state, event) {
            state.total++;
            state.data.push(
                {
                    orderId: event.body.id,
                    orderCreatedAt: event.body.createdAt,
                    orderAmount: event.body.amount,
                    userId: event.body.userId,
                    userFullName: event.body.userFullName
                }
            );
        }
    }
)