import os
import pandas as pd
from dotenv import load_dotenv
import streamlit as st
from langchain.schema import Document
from langchain_text_splitters.character import RecursiveCharacterTextSplitter
from langchain_community.vectorstores import FAISS
from langchain.memory import ConversationBufferMemory
from langchain.chains import ConversationalRetrievalChain
from langchain_google_genai import ChatGoogleGenerativeAI
from langchain_huggingface import HuggingFaceEmbeddings

load_dotenv()
os.environ["KMP_DUPLICATE_LIB_OK"] = "TRUE"

working_dir = os.path.dirname(os.path.abspath(__file__))


def load_csv_as_documents(file_path):
    df = pd.read_csv(file_path)
    docs = []
    for _, row in df.iterrows():
        text = (
            f"Tên sản phẩm: {row['name']}\n"
            f"Slug: {row['slug']}\n"
            f"Mô tả: {row['description']}\n"
            f"Tóm tắt: {row['summary']}\n"
            f"Kho: {row['stock']} {row['unit']}\n"
            f"Giá gốc: {row['price']}\n"
            f"Giá KM: {row['disscounted_price']}\n"
            f"Category ID: {row['category_id']}\n"
            f"Brand ID: {row['brand_id']}\n"
            f"Trạng thái: {row['status']}"
        )
        docs.append(Document(page_content=text))
    return docs


def setup_vectorstore(documents):
    embeddings = HuggingFaceEmbeddings()
    text_splitter = RecursiveCharacterTextSplitter(
        chunk_size=1200,
        chunk_overlap=200
    )
    doc_chunks = text_splitter.split_documents(documents)
    vectorstore = FAISS.from_documents(doc_chunks, embeddings)
    return vectorstore


def create_chain(vectorstore):
    llm = ChatGoogleGenerativeAI(model="gemini-1.5-pro")
    retriever = vectorstore.as_retriever()
    memory = ConversationBufferMemory(
        llm=llm,
        output_key="answer",
        memory_key="chat_history",
        return_messages=True
    )
    chain = ConversationalRetrievalChain.from_llm(
        llm=llm,
        retriever=retriever,
        chain_type="map_reduce",
        memory=memory,
        verbose=True
    )
    return chain


st.title("🤖 RAG Chatbot Tư Vấn Sản Phẩm từ CSV")

if "chat_history" not in st.session_state:
    st.session_state.chat_history = []

uploaded_file = st.file_uploader("Upload file CSV sản phẩm", type=["csv"])

if uploaded_file is not None:
    file_path = os.path.join(working_dir, "upload", uploaded_file.name)
    os.makedirs(os.path.dirname(file_path), exist_ok=True)

    if os.path.exists(file_path):
        os.remove(file_path)

    with open(file_path, "wb") as f:
        f.write(uploaded_file.getbuffer())

    documents = load_csv_as_documents(file_path)

    st.session_state.vectorstore = setup_vectorstore(documents)
    st.session_state.conversation_chain = create_chain(st.session_state.vectorstore)

if "vectorstore" in st.session_state and "conversation_chain" in st.session_state:
    for message in st.session_state.chat_history:
        with st.chat_message(message["role"]):
            st.markdown(message["content"])

    user_input = st.chat_input("Hỏi sản phẩm...")

    if user_input:
        st.session_state.chat_history.append({"role": "user", "content": user_input})
        with st.chat_message("user"):
            st.markdown(user_input)

        with st.chat_message("assistant"):
            response = st.session_state.conversation_chain({"question": user_input})
            assistant_response = response["answer"]
            st.markdown(assistant_response)
            st.session_state.chat_history.append({"role": "assistant", "content": assistant_response})
